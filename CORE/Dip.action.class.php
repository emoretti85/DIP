<?php
class DipAction{

    private static function LOG($Content){
        if(is_string($Content))
            file_put_contents(LOG_PATH."RunLog_".date("d-m-Y_Hms").".log",$Content);
        elseif (is_array($Content))
        foreach ($Content as $value) {
            file_put_contents(LOG_PATH."RunLog_".date("d-m-Y_Hms").".log", "[WARNING]\t".$value, FILE_APPEND | LOCK_EX);
        }
    }

    private static function SEND_EMAIL($Content){
        try {
            $to      = EMAIL_ADDRESSES;
            $subject = EMAIL_SUBJECT;
            $message = '';

            if(is_string($Content))
                $message=$Content;
            elseif (is_array($Content))
            foreach ($Content as $value) {
                $message.= "[WARNING]\t".$value;
            }

            $headers = 'From:'.EMAIL_FROM . "\r\n" .
                            'Reply-To: '.EMAIL_REPLYTO . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        } catch (Exception $e) {
            file_put_contents(CORE_LOG."CoreLog_".date("d-m-Y_Hms").".log","[ERROR][".date('d/m/Y H:m:s')."]\t".$e->getMessage(), FILE_APPEND | LOCK_EX);
        }
    }

    private static function EMERGENCYPAGE(){
        try {
            //Rename the index page
            if(file_exists(APP_INDEX_PAGE))
                rename(APP_INDEX_PAGE, APP_INDEX_PAGE.".bak");
            //Copy emergency page and rename it
            copy(EMERGENCY_PAGE, APP_INDEX_PAGE);
        } catch (Exception $e) {

            file_put_contents(CORE_LOG."CoreLog_".date("d-m-Y_Hms").".log","[ERROR][".date('d/m/Y H:m:s')."]\t".$e->getMessage(), FILE_APPEND | LOCK_EX);
        }
    }


    public static function _DO($Action,$Content){
        switch ($Action) {
            case 'LOGIT':
                DipAction::LOG($Content);
                break;

            case 'SENDMAIL' :
                DipAction::SEND_EMAIL($Content);
                break;

            case 'LOGNSEND':
                DipAction::LOG($Content);
                DipAction::SEND_EMAIL($Content);
                break;

            case 'LOGNSENDNPATCHIT':
                DipAction::LOG($Content);
                DipAction::SEND_EMAIL($Content);
                DipAction::EMERGENCYPAGE();
                break;
            default:
                DipAction::LOG($Content);
                break;
        }
    }

}
