# How to install?

Install Azuriom then click `Dofus 1.29` when it ask you which game to choose.
Follow the installation process, it's very easy.

Depending on how is setup your database you might see errors like:

```
SQLSTATE[HY000]: General error: 1364 Field 'lastConnectionDate' doesn't have a default value (SQL: insert into `accounts` (`account`, `pseudo`, `pass`, `question`, `reponse`) values (TsO9QEd7, wGkv27uI, 7pcJXu8S, E2bQi60B, KVDr2lFM))
```

If you don't know how to fix this kind of error, look it up on google. 
You either would need to set a default value or allow null values.

# Created an in-game account but cannot login?

Your emulator is probably using a custom hash for the password. It can be changed in the setting of the dofus plugin `Custom hash algo`.

For example if your emulator use a salted password with md5 you can write :

- `md5($password.'my-salt');`




# How can I have instant commands on my dofus server with Azuriom?

## Server side (java, but you can code the equivalent in any other language)

<details> 
  <summary>You need to add this class to your server (click me)</summary>
 

 ```java
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.ServerSocket;
import java.net.Socket;
import java.security.KeyStore;

import javax.net.ssl.KeyManagerFactory;
import javax.net.ssl.SSLContext;
import javax.net.ssl.SSLServerSocketFactory;

import java.io.ByteArrayInputStream;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.security.KeyFactory;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.PrivateKey;
import java.security.cert.CertificateException;
import java.security.cert.CertificateFactory;
import java.security.cert.X509Certificate;
import java.security.interfaces.RSAPrivateKey;
import java.security.spec.InvalidKeySpecException;
import java.security.spec.PKCS8EncodedKeySpec;
import java.util.ArrayList;
import java.util.List;

import javax.net.ssl.KeyManager;
import javax.xml.bind.DatatypeConverter;

public class AzuriomCommands implements Runnable{

    private ServerSocket listen_socket;
    protected final static String KEYSTORE_PASSWORD = "password";
    protected final static String CERTIFICATE_PATH = "C:/laragon/www/azuriom/storage/app/server.pem";

    public AzuriomCommands(int port)
    {
        try {
            listen_socket = PEMImporter.createSSLFactory(new File(CERTIFICATE_PATH), KEYSTORE_PASSWORD).createServerSocket(port);
        } catch (Exception e) {
            System.err.println(e.getMessage());
            System.exit(-1);
        }
    }

    @Override
    public void run() {
        while (true) { 
            try{
                (new Thread(new ClientSocket(listen_socket.accept()))).start();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public void start() {
		(new Thread(this)).start();		
	}

    /**
     * https://stackoverflow.com/a/48173910
     */
    private static class PEMImporter {

        public static SSLServerSocketFactory createSSLFactory(File certificatePem, String password) throws Exception {
            final SSLContext context = SSLContext.getInstance("TLS");
            final KeyStore keystore = createKeyStore(certificatePem, password);
            final KeyManagerFactory kmf = KeyManagerFactory.getInstance("SunX509");
            kmf.init(keystore, password.toCharArray());
            final KeyManager[] km = kmf.getKeyManagers();
            context.init(km, null, null);
            return context.getServerSocketFactory();
        }
    
        /**
         * Create a KeyStore from standard PEM files
         * 
         * @param privateKeyPem the private key PEM file
         * @param certificatePem the certificate(s) PEM file
         * @param password the password to set to protect the private key
         */
        public static KeyStore createKeyStore(File certificatePem, final String password)
                throws Exception, KeyStoreException, IOException, NoSuchAlgorithmException, CertificateException {
            final X509Certificate[] cert = createCertificates(certificatePem);
            final KeyStore keystore = KeyStore.getInstance("JKS");
            keystore.load(null);
            final PrivateKey key = createPrivateKey(certificatePem);
            keystore.setKeyEntry(certificatePem.getName(), key, password.toCharArray(), cert);
            keystore.setCertificateEntry("server", cert[0]);
            return keystore;
        }
    
        private static PrivateKey createPrivateKey(File privateKeyPem) throws Exception {
            final BufferedReader r = new BufferedReader(new FileReader(privateKeyPem));
            String s = r.readLine();
            while (!s.contains("BEGIN PRIVATE KEY")) {
               s = r.readLine();
               if (s == null){
                    r.close();
                    throw new IllegalArgumentException("No PRIVATE KEY found");
               }
            }

            final StringBuilder b = new StringBuilder();
            s = "";
            while (s != null) {
                if (s.contains("END PRIVATE KEY")) {
                    break;
                }
                b.append(s);
                s = r.readLine();
            }
            r.close();
            final String hexString = b.toString();
            final byte[] bytes = DatatypeConverter.parseBase64Binary(hexString);
            return generatePrivateKeyFromDER(bytes);
        }
    
        private static X509Certificate[] createCertificates(File certificatePem) throws Exception {
            final List<X509Certificate> result = new ArrayList<X509Certificate>();
            final BufferedReader r = new BufferedReader(new FileReader(certificatePem));

            String s = r.readLine();
            while (!s.contains("BEGIN CERTIFICATE")) {
               s = r.readLine();
               if (s == null){
                    r.close();
                    throw new IllegalArgumentException("No CERTIFICATE found");
               }
            }

            StringBuilder b = new StringBuilder();
            while (s != null) {
                if (s.contains("END CERTIFICATE")) {
                    String hexString = b.toString();
                    final byte[] bytes = DatatypeConverter.parseBase64Binary(hexString);
                    X509Certificate cert = generateCertificateFromDER(bytes);
                    result.add(cert);
                    b = new StringBuilder();
                } else {
                    if (!s.startsWith("----")) {
                        b.append(s);
                    }
                }
                s = r.readLine();
            }
            r.close();
    
            return result.toArray(new X509Certificate[result.size()]);
        }
    
        private static RSAPrivateKey generatePrivateKeyFromDER(byte[] keyBytes) throws InvalidKeySpecException, NoSuchAlgorithmException {
            final PKCS8EncodedKeySpec spec = new PKCS8EncodedKeySpec(keyBytes);
            final KeyFactory factory = KeyFactory.getInstance("RSA");
            return (RSAPrivateKey) factory.generatePrivate(spec);
        }
    
        private static X509Certificate generateCertificateFromDER(byte[] certBytes) throws CertificateException {
            final CertificateFactory factory = CertificateFactory.getInstance("X.509");
            return (X509Certificate) factory.generateCertificate(new ByteArrayInputStream(certBytes));
        }
    
    }

    private class ClientSocket implements Runnable
    {
        private Socket socket;

        public ClientSocket(Socket socket){
            this.socket = socket;
        }

        @Override
        public void run() {
            BufferedReader in;
            try {
                in = new BufferedReader (new InputStreamReader(this.socket.getInputStream()));
                String command = null;
                while ((command = in.readLine()) != null) {
                    System.out.println("Command : "+command);
                    this.parseCommand(command.split(" "));
                }
            } catch (Exception e) {
                System.out.println(e.getMessage());
            }
        }

        private void parseCommand(String[] command){

            switch (command[0].toLowerCase()) {
                case "give":
                    //Command is : give playerId itemId quantity
                    //giveCommand(Integer.valueOf(command[1]), Integer.valueOf(command[2]), Integer.valueOf(command[3]));
                    break;
            
                default:
                    break;
            }
        }
    }
}

 ```
 </details>
	
 This class implements a secure socket connection using a self-signed SSL certificate.

 ### How to use it?
 
- Change `KEYSTORE_PASSWORD` to a difficult password
- In the CMS go to the settings of the Dofus plugin and click `Generate certificate`
- From your VPS download the certificate and save it somewhere. Then change `CERTIFICATE_PATH` in the `AzuriomCommands.java` to the path you save the certificate
- Add this code to your Game server source code : 
```java
	new AzuriomCommands(2333).start(); // 2333 can be any available port on your machine
```
## In Azuriom

- Make sure to register your server in the server section of the Azuriom admin panel

- Make sure to select the server you registered in the package that you're creating in the shop!

- create the commands you need in `parseCommand` function and write them in the command section of a package
