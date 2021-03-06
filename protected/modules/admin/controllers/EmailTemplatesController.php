<?php

class EmailTemplatesController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'EmailTemplates') ] = array('emailTemplates/index');
		$this->pageTitle[] = Yii::t('global', 'EmailTemplates');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    public function actionLoad($id)
	{

		$model = $this->loadModel($id);
        echo json_encode($model->attributes);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EmailTemplates;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
        //need copy
        if (isset($_GET['language'])) 
            $model->language = $_GET['language'];
        else
            $model->language = Yii::app()->language;            
        if (isset($_GET['alias'])) $model->alias = $_GET['alias'];
        //end copy

		if(isset($_POST['EmailTemplates']))
		{
			$model->attributes=$_POST['EmailTemplates'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailTemplates']))
		{
			$model->attributes=$_POST['EmailTemplates'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new EmailTemplates('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmailTemplates']))
			$model->attributes=$_GET['EmailTemplates'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('EmailTemplates');
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=EmailTemplates::model()->findByPk((int)$id);
		if($model===null)
			//throw new CHttpException(404,'The requested page does not exist.');
            $this->redirect('/admin/emailTemplates');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emailTemplates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
