<?php

namespace App\Uploader;

use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FTPUploader
{

    public function __construct(private string $sftpHost, private string $sftpUser, private string $sftpPass)
    {
    }

    public function upload(string $localFilePath, string $remoteFilePath): bool
    {
        $conn = ftp_connect($this->sftpHost);
        $login = ftp_login($conn, $this->sftpUser, $this->sftpPass);

        if ($conn && $login) {
            $upload = ftp_put($conn, $remoteFilePath, $localFilePath);
            ftp_close($conn);

            return $upload;
        }

        return false;
    }

    public function uploadAppImg(UploadedFile $file): string
    {
        $localFilePath = $file->getPathname();
        $newFilename = 'img/app/'.$file->getClientOriginalName();
        $remoteFilePath = '/domains/salwa.com.pl/public_html/cdn/'.$newFilename;

        if ($this->upload($localFilePath, $remoteFilePath)) {
            return $newFilename;
        }
        throw new UploadException('could not upload file to ftp server');
    }

    public function uploadFeatureImg(UploadedFile $file): string
    {
        $localFilePath = $file->getPathname();
        $newFilename = 'img/feature/'.$file->getClientOriginalName();
        $remoteFilePath = '/domains/salwa.com.pl/public_html/cdn/'.$newFilename;

        if ($this->upload($localFilePath, $remoteFilePath)) {
            return $newFilename;
        }
        throw new UploadException('could not upload file to ftp server');
    }
}
