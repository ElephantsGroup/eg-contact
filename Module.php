<?php

namespace elephantsGroup\contact;

/*
	Module statistics for Yii 2
	Authors : Jalal Jaberi
	Website : http://elephantsgroup.com
	Revision date : 2016/07/09
*/

use Yii;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['contact']))
		{
            Yii::$app->i18n->translations['contact'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
    }

    public static function t($message, $params = [], $language = null)
    {
        return \Yii::t('contact', $message, $params, $language);
    }
}
