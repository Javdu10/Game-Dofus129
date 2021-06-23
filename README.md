# How can I have instant commands on my dofus server with Azuriom?

## Server side (java, but you can code the equivalent in any other language)

<details> 
  <summary>You need to add this class to your server (click me)</summary>
 

 ```java
 public class AzuriomCommands implements Runnable{

    private ServerSocket listen_socket;
    protected final static String AZURIOM_PASSWORD = "password"; //For security, please change this password

    public AzuriomCommands(int port)
    {
        try {
            listen_socket = new ServerSocket(port);
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

    private class ClientSocket implements Runnable
    {
        private Socket socket;

        public ClientSocket(Socket socket){
            this.socket = socket;
        }

        private String dc_decrypt(String str, String key)
        {
            StringBuilder sb = new StringBuilder();
            for(int i = 0; i < str.length(); i++)
                sb.append((char)(str.charAt(i) ^ key.charAt(i % (key.length()))));
            return sb.toString();
        }

        @Override
        public void run() {

            BufferedReader in;
            try {
                this.socket.setSoTimeout(5000); //5 secondes timeout
                in = new BufferedReader (new InputStreamReader(this.socket.getInputStream()));
                String command = this.dc_decrypt(in.readLine(), AzuriomCommands.AZURIOM_PASSWORD);

                this.parseCommand(command.split(" "));
            } catch (Exception e) {
                e.printStackTrace();
            }
        }

        private void parseCommand(String[] command){

            switch (command[0].toLowerCase()) {
                case "give":
                    // a give command that you create
                    break;
            
                default:
                    break;
            }
        }
    }
}

 ```
 </details>
 
 - How to use it?
 
Fix the imports and make sure to change `AZURIOM_PASSWORD` to a difficult password then simply add this code to your game main function:

```java
new AzuriomCommands(2333).start(); // 2333 can be any available port on your machine
```
## In Azuriom

- In the dofus plugin settings all you have to do is fill in the password
- Register you server in the server section of the admin panel
- go to the shop plugin, add packages and add commands like `give {player} xxx 1` where xxx is an item id

Make sure to select the server you registered in the package you created!
