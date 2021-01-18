<?php

declare(strict_types=1);
/**
 * This file is part of MoChat.
 * @link     https://mo.chat
 * @document https://mochat.wiki
 * @contact  group@mo.chat
 * @license  https://github.com/mochat-cloud/mochat/blob/master/LICENSE
 */
namespace App\Constants\User;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * @method static getMessage($code, array $options = []) 获取枚举值
 */
class Status extends AbstractConstants
{
    /**
     * @Message("未启用")
     */
    const NOT_ENABLED = 0;

    /**
     * @Message("正常")
     */
    const NORMAL = 1;

    /**
     * @Message("禁用")
     */
    const DISABLE = 2;
}
