<?php

declare(strict_types=1);
/**
 * This file is part of MoChat.
 * @link     https://mo.chat
 * @document https://mochat.wiki
 * @contact  group@mo.chat
 * @license  https://github.com/mochat-cloud/mochat/blob/master/LICENSE
 */
namespace App\Action\Agent;

use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use League\Flysystem\FileExistsException;
use MoChat\Framework\Action\AbstractAction;
use MoChat\Framework\Constants\ErrorCode;
use MoChat\Framework\Exception\CommonException;

/**
 * @Controller
 */
class TxtVerifyUpload extends AbstractAction
{
    /**
     * @RequestMapping(path="/agent/txtVerifyUpload", methods="POST")
     * @return array ...
     */
    public function handle(FilesystemFactory $factory): array
    {
        $file = $this->request->file('file');
        if ($file->getMimeType() !== 'text/plain') {
            throw new CommonException(ErrorCode::INVALID_PARAMS, '文件类型错误');
        }
        $local = $factory->get('local');
        $local->getAdapter()->setPathPrefix(BASE_PATH . '/public');

        try {
            $local->write($file->getClientFilename(), $file->getStream());
        } catch (FileExistsException $e) {
            throw new CommonException(ErrorCode::INVALID_PARAMS, '上传失败:已经存在此文件名的文件');
        } catch (\Exception $e) {
            throw new CommonException(ErrorCode::SERVER_ERROR, '上传失败:' . $e->getMessage());
        }

        return [];
    }
}
