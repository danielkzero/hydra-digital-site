<?php

declare(strict_types=1);

namespace App\Application\Actions\Upload;

use App\Application\Actions\Action;
use App\Application\Settings\SettingsInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class UploadImageAction extends Action
{
    private SettingsInterface $settings;

    public function __construct(LoggerInterface $logger, SettingsInterface $settings)
    {
        parent::__construct($logger);
        $this->settings = $settings;
    }

    protected function action(): Response
    {
        $uploadedFiles = $this->request->getUploadedFiles();
        $image = $uploadedFiles['image'] ?? null;

        if (!$image instanceof UploadedFileInterface || $image->getError() !== UPLOAD_ERR_OK) {
            throw new HttpBadRequestException($this->request, 'Envie uma imagem válida.');
        }

        $extension = pathinfo($image->getClientFilename() ?? 'image', PATHINFO_EXTENSION);
        $filename = bin2hex(random_bytes(16)) . ($extension ? ".{$extension}" : '');

        $uploadDir = $this->settings->get('uploads')['path'];
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $image->moveTo($uploadDir . DIRECTORY_SEPARATOR . $filename);

        return $this->respondWithData([
            'path' => '/api/uploads/' . $filename,
        ], 201);
    }
}
