<?php

namespace elephantsGroup\contact\components;

use Yii;
use elephantsGroup\contact\models\ContactUs;
use elephantsGroup\contact\models\ContactUsSearch;
use yii\base\Widget;
use yii\helpers\Html;

class Contact extends Widget
{
	public $language;
    public $enabled_name = true;
    public $enabled_subject = true;
    public $enabled_description = true;

    public $view_file = 'contact';

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('contact', 'View File');
	}

    public function run()
	{
        return $this->render($this->view_file, [
            'enabled_name' => $this->enabled_name,
            'enabled_subject' => $this->enabled_subject,
            'enabled_description' => $this->enabled_description,
        ]);
	}
}