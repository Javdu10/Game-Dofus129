<?php

namespace Azuriom\Plugin\Dofus129\Controllers\Admin;

use Azuriom\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Requests\AdminAccountRequest;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dofus129::admin.index', [
            'certificate' => Storage::exists('server.pem') ? route('dofus129.admin.certificate') : false,
        ]);
    }

    public function updateSettings(AdminAccountRequest $request)
    {
        Setting::updateSettings($request->validated() + [
            'dofus129_create_account_on_registration' => $request->filled('dofus129_create_account_on_registration')
        ]);

        return redirect()->route('dofus129.admin.index')->with('success', 'Settings updated!');
    }

    public function testAccountCreation()
    {
        try {
            $account = new Account();
            $account->{setting('dofus129_accounts_nameCol')} = Str::random(8);
            $account->{setting('dofus129_accounts_pseudoCol')} = Str::random(8);
            $account->{setting('dofus129_accounts_passwordCol')} = Str::random(8);
            $account->{setting('dofus129_accounts_questionCol')} = Str::random(8);
            $account->{setting('dofus129_accounts_answerCol')} = Str::random(8);
            $account->save();
    
            $account->delete();
        } catch (\Throwable $th) {
            return redirect()->route('dofus129.admin.index')->with('error', $th->getMessage());
        }

        return redirect()->route('dofus129.admin.index')->with('success', 'Account success!');
    }

    public function certificate()
    {
        return Storage::download('server.pem');
    }

    public function generateCertificate()
    {
        try {
            if (!Storage::exists('openssl.conf')) {
                $this->createOpenSslConf();
            }
            $config = array(
                'config' => Storage::path('openssl.conf'),
            );
            $locale = strtoupper(app()->getLocale());
            $sitename = site_name();
            $certificateData = array(
                "countryName" => $locale,
                "stateOrProvinceName" => $locale,
                "localityName" => $locale,
                "organizationName" => $sitename,
                "organizationalUnitName" => $sitename,
                "commonName" => $sitename,
                "emailAddress" => $sitename,
            );
            
            // Generate certificate
            $privateKey = openssl_pkey_new($config);
            $certificate = openssl_csr_new($certificateData, $privateKey, $config);
            
            $certificate = openssl_csr_sign($certificate, null, $privateKey, 365, $config);
            
            // Generate PEM file
            $pem_passphrase = null; // empty for no passphrase
            $privateKeyPem = null;
            $certificatePem = null;
            openssl_x509_export($certificate, $certificatePem);
            openssl_pkey_export($privateKey, $privateKeyPem, $pem_passphrase, $config);
    
            Storage::put('server.pem', $certificatePem.$privateKeyPem);
    
            return redirect()->route('dofus129.admin.index')->with('success', 'Certificate Generated');
        } catch (\Throwable $th) {
            return redirect()->route('dofus129.admin.index')->with('error', $th->getMessage());
        }
    }

    public function testConnection()
    {
        try {
            $host = '127.0.0.1';
            $port = 2333;
            $timeout = 30;
            
            $context = stream_context_create(
                ['ssl'=>[
                    'local_cert'=> 'C:/laragon/www/azuriom/storage/app/server.pem',
                    //"verify_peer"=>false,
                    "verify_peer_name"=>false,
                    'allow_self_signed' => true
                ]]
            );
            if ($socket = stream_socket_client(
                'ssl://'.$host.':'.$port,
                $errno,
                $errstr,
                $timeout,
                STREAM_CLIENT_CONNECT,
                $context
            )
            ) {
                fwrite($socket, "Hello\n");
                fclose($socket);
                return redirect()->route('dofus129.admin.index')->with('success', 'Connection OK');
            } else {
                return redirect()->route('dofus129.admin.index')->with('error', "ERROR: .$errno - $errstr");
            }
        } catch (\Throwable $th) {
            return redirect()->route('dofus129.admin.index')->with('error', $th->getMessage());
        }
    }

    private function createOpenSslConf()
    {
        $conf = <<<EOT
        [req]
        default_bits = 2048
        distinguished_name = req_distinguished_name
        req_extensions = v3_req
        prompt = no

        [req_distinguished_name]
        C  = SG
        ST = Singapore
        L  = Singapore
        O  = Laragon
        OU = IT
        CN = laragon

        [v3_req]
        keyUsage = keyEncipherment, dataEncipherment
        extendedKeyUsage = serverAuth
        subjectAltName = @alt_names

        [alt_names]
        DNS.1 = localhost
        EOT;

        Storage::put('openssl.conf', $conf);
    }
}
