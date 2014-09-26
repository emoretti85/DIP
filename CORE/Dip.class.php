<?php

class DIP{
    /**
     * Err => Return Error var
     */
    private $Err;
    private $Report;
    protected $KEY;

    public function __construct($K){

        ($K=="" || count($K)<=0)?$this->Err="{CRITICAL ERROR} Script lauched without PersonalKey.":'';
        ($this->Err!="")?exit($this->Err):'';
         
        $this->KEY=$K;
        //RAP exists?
        (!$this->isDir(RAP))?$this->Err="{CRITICAL ERROR} Root Application path, CORRUPTED or ERASED.":'';
        ($this->Err!="")?exit($this->Err):'';
        //I try to Load the previous control information
        //CIA Path exits?
        (!$this->isDir(CIA_PATH))?$this->Err="{CRITICAL ERROR} Control Information Application path, CORRUPTED or ERASED.":'';
        ($this->Err!="")?exit($this->Err):'';
        //Have some previous launch file?
        ($this->fileCountInDir(CIA_PATH)<=0 && !CREATE_OR_UPDATE)?$this->Err="{CRITICAL ERROR} Previous file in CIA path are ERASED.":'';
        ($this->Err!="")?exit($this->Err):'';
        //If CREATE_OR_UPDATE TRUE create list and file else control the previous file
        if(CREATE_OR_UPDATE){
            $Md5List= $this->createMd5(RAP);
            $this->writeMd5ToFile($Md5List);
        }else
            $this->Md5ListControl();
    }

    public function getResult(){
        /*echo "<pre>";
         var_dump($this->Err);
        print_r("<br/>");
        var_dump(CREATE_OR_UPDATE);
        print_r("<br/>");
        var_dump($this->Report);
        exit;  */
        //If Md5ListControl found some ERROR or ALERT
        if(CREATE_OR_UPDATE){
            if($this->Err!="")
                return($this->Err);
            else
                return("File di controllo creato correttamente!.");
        }else{
            if(isset($this->Report))
                return $this->Report;
            else
                return("Il controllo non ha evidenziato problemi!.");
        }
    }


    private function Md5ListControl(){
        //Get last previous control file
        $lastFileName=$this->getLatestControlFile(CIA_PATH);
        if($lastFileName==""){
            $this->Err="{CRITICAL ERROR} No control files found.";
            return;
        }

        //Decript the file
        $FileCONTENT=$this->mc_decrypt(file_get_contents(CIA_PATH.$lastFileName), $this->KEY);
        //Get actual md5
        $ActualMd5=$this->createMd5(RAP);
         
        //Start control
        $AlertCnt=0;


        foreach ($FileCONTENT as $Filekey => $filevalue) {
            if($filevalue['Type']=='Dir'){
                //Controllo che il path esista
                if(!file_exists($filevalue['Path'])){
                    $this->Report[$AlertCnt]="Directory ".$filevalue['Name']." not found in the path".$filevalue['Path'];
                    if(count($filevalue['md5'])>0){
                        $this->Report[$AlertCnt].="\nIt contained ".count($filevalue['md5'])." file(s):\n";
                        foreach ($filevalue['md5'] as $md5value) {
                            $this->Report[$AlertCnt].="Filename: ".$md5value['Name']."\tMD5Hash:".$md5value['md5']."\n";
                        }
                    }
                    $AlertCnt++;
                }else{
                    if(count($filevalue['md5'])>0){
                        foreach ($filevalue['md5'] as $md5key=> $md5value) {
                            if(!file_exists($md5value['Path'])){
                                $this->Report[$AlertCnt]="File ".$md5value['Name']." not found in the path: ".$md5value['Path']."\tMD5Hash:".$md5value['md5']."\n";
                                $AlertCnt++;
                            }else{
                                if(!isset($ActualMd5[$Filekey]['md5'][$md5key]['md5'])){
                                    $this->Report[$AlertCnt]="File ".$md5value['Name']." does not exist.\n";
                                    $AlertCnt++;
                                }else{
                                    if($md5value['md5']!==$ActualMd5[$Filekey]['md5'][$md5key]['md5'])
                                        $this->Report[$AlertCnt]="File ".$md5value['Name']." is changed. \n\tPrevious MD5Hash: ".$md5value['md5']."\n\t Actual MD5Hash: ".$ActualMd5[$Filekey]['md5'][$md5key]['md5']."\n";
                                    $AlertCnt++;
                                }
                            }
                        }
                    }
                }
            }else{
                //Devo fare i controlli per i file simili a sopra senza foreach incapsulati
                if(!file_exists($filevalue['Path'])){
                    $this->Report[$AlertCnt]="File ".$filevalue['Name']." not found in the path: ".$filevalue['Path'];
                    $AlertCnt++;
                }else{
                    if(!isset($ActualMd5[$Filekey]['md5'])){
                        $this->Report[$AlertCnt]="File ".$md5value['Name']." does not exist.\n";
                        $AlertCnt++;
                    }else{
                        if($filevalue['md5']!==$ActualMd5[$Filekey]['md5'])
                            $this->Report[$AlertCnt]="File ".$filevalue['Name']." is changed. \n\tPrevious MD5Hash: ".$filevalue['md5']."\n\t Actual MD5Hash: ".$ActualMd5[$Filekey]['md5']."\n";
                        $AlertCnt++;
                    }
                }
            }
        }

        (isset($this->Report))?$this->Report = array_values( $this->Report):'';
    }

    /**
     * createMd5 get the md5 hash of the entire file and directory
     * @return boolean
     */
    private function createMd5($dir)
    {
        if (!is_dir($dir))
            return false;

        $filemd5s = array();
        $d = dir($dir);
        $cnt=0;

        while (false !== ($entry = $d->read()))
        {
            if ($entry != '.' && $entry != '..')
            {
                if (is_dir($dir.'/'.$entry))
                {
                    $filemd5s[$cnt]['Type']="Dir";
                    $filemd5s[$cnt]['Name']=$entry;
                    $filemd5s[$cnt]['Path']=$dir.'/'.$entry;
                    $filemd5s[$cnt]['md5'] = $this->createMd5($dir.'/'.$entry);
                    $cnt++;
                }
                else
                {
                    $filemd5s[$cnt]['Type']="File";
                    $filemd5s[$cnt]['Name']=$entry;
                    $filemd5s[$cnt]['Path']=$dir.'/'.$entry;
                    $filemd5s[$cnt]['md5'] = md5_file($dir.'/'.$entry);
                    $cnt++;
                }
            }
        }
        $d->close();

        return $filemd5s;
    }

    private function writeMd5ToFile($array){
        file_put_contents(CIA_PATH."Cnt_".date("dmY_Hms").".md5", $this->mc_encrypt($array,$this->KEY));
    }

    private function isDir($P){
        return is_dir($P);
    }

    private function fileCountInDir($P){
        // Count number of files in directory
        return count(array_diff( scandir($P), array(".", "..") ));
    }

    private function getLatestControlFile($dir){
        //  $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $lastMod = 0;
        $lastModFile = '';
        foreach (scandir($dir) as $entry) {
            if (is_file($dir.$entry) && filectime($dir.$entry) > $lastMod) {
                $lastMod = filectime($dir.$entry);
                $lastModFile = $entry;
            }
        }
        return $lastModFile;
    }

    private function mc_encrypt($encrypt, $key){
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
        return $encoded;
    }


    private function mc_decrypt($decrypt, $key){
        $decrypt = explode('|', $decrypt);
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if($calcmac!==$mac){
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

}
