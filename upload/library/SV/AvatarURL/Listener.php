<?php

class SV_AvatarURL_Listener
{
	protected static $_helperCallbackAvatar;

	public static function init_dependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
		self::$_helperCallbackAvatar = XenForo_Template_Helper_Core::$helperCallbacks['avatar'];
		if (self::$_helperCallbackAvatar[0] === 'self')
		{
			self::$_helperCallbackAvatar[0] = 'XenForo_Template_Helper_Core';
		}

		XenForo_Template_Helper_Core::$helperCallbacks['avatar'] = array(
			__CLASS__,
			'helperAvatarUrl'
		);
	}


	public static function helperAvatarUrl($user, $size, $forceType = null, $canonical = false)
	{
		if (!empty($user['user_id']) && $forceType != 'default' && !empty($user['avatar_date']))
		{
			$group = floor($user['user_id'] / 1000);
			return XenForo_Application::$externalDataUrl . "/avatar/$user[avatar_date]/$size/$group/$user[user_id].jpg";
		}

		return call_user_func(self::$_helperCallbackAvatar, $user, $size, $forceType, $canonical);
	}


}
