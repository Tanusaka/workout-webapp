<?php
/**
 *
 * @author Samu
 */
namespace App\Libraries;

use Vendor\Autoload;
use Aws\S3\S3Client;

class S3bucket {

    public static function uploadToBucket($filename='')
    {
        $CI =& get_instance();

        $s3Client = new S3Client([
			'version' => 'latest',
			'region'  => $CI->appconfigs->S3_REGION, //YOUR_AWS_REGION
			'credentials' => [
				'key'    => $CI->appconfigs->S3_ACCESS_KEY, //ACCESS_KEY_ID
				'secret' => $CI->appconfigs->S3_SECRET_ACCESS_KEY //SECRET_ACCESS_KEY
			]
		]);

		
		$bucket = $CI->appconfigs->S3_BUCKET_NAME;  //bucket name
		$file_Path = WRITEPATH . 'uploads/temp/'.$filename;
		$key = basename($file_Path);

		try {
			
			$result = $s3Client->putObject([
				'Bucket' => $bucket,
				'Key'    => $key,
				'SourceFile' => $file_Path,
				'ContentType' => 'image',
				// 'ACL' => 'public-read',
				'StorageClass' => 'REDUCED_REDUNDANCY',
			]);

		} catch (Aws\S3\Exception\S3Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e->getMessage()]);
			$result = 0;
		}

		return $result;
    }

}