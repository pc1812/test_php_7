<?php
namespace App;

use \Exception;

class Uploader {
	
	private $toDir;
	private $acceptedExts;
	
	public function __construct($uploadDir, $acceptedExts)
	{
		$this->toDir = $uploadDir;
		$this->acceptedExts = $acceptedExts;
	}
	
	public function upload($inputName, $callback, $unique='')
	{
		foreach ($_FILES[$inputName]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES[$inputName]["tmp_name"][$key];
				// basename() may prevent filesystem traversal attacks;
				// further validation/sanitation of the filename may be appropriate
				$name = basename($_FILES[$inputName]["name"][$key]);
				unset($toName);
				if (strlen($name) > 0) {
					foreach ($this->acceptedExts as $ext) {
						if (strlen($ext) > 0 && substr($name, -strlen($ext)) == $ext) {
							$toName = $unique.'-'.basename($tmp_name).$ext;
							break;
						}
					}
				}
				if (isset($toName)) {
					move_uploaded_file($tmp_name, $this->toDir."/".$toName);
					$callback($tmp_name, $toName);
				}
				else {
					Logger::instance()->exception(new Exception('Uploaded file '.$name.' is not accepted!'));
				}
			}
		}
	}
}


?>