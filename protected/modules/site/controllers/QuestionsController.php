<?php

class QuestionsController extends SiteBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Questions') ] = array('questions/index');
		$this->pageTitle[] = Yii::t('global', 'Questions');
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Questions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
        $this->layout = 'support';
        $dataProvider = new CActiveDataProvider('Questions',array( 
                                                            'pagination' => array('pageSize' =>3,),
                                                            'criteria'=>array(
                                                                           /* 'condition'=>'status=1',*/
                                                                            'order'=>'datequestion DESC',
                                                                            /*'with'=>array('author'),*/
                                                                            ),
                                                                                                                
                                                            )
                                                );
			if(isset($_POST['Questions']))
		{
		  //var_dump('aaaa'); exit();
			$model->attributes=$_POST['Questions'];
            $model->datequestion=date('Y-m-d H:i:s');
			if($model->save())
           {
			$this->redirect('index', array(
            'dataProvider' => $dataProvider,'model'=>$model));
            }else{
                $this->render('create', array(
            'dataProvider' => $dataProvider,'model'=>$model));
            }
		}
        else{
            $this->render('create',array(
			'dataProvider' => $dataProvider,'model'=>$model,
		));
        }
        	
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
        
		if(isset($_POST['Questions']))
		{
			$model->attributes=$_POST['Questions'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model=new Questions('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Questions']))
			$model->attributes=$_GET['Questions'];
   
        $this->layout = 'support';
        $dataProvider = new CActiveDataProvider('Questions',array( 
                                                            'pagination' => array('pageSize' =>3,),
                                                            'criteria'=>array(
                                                                           /* 'condition'=>'status=1',*/
                                                                            'order'=>'datequestion DESC',
                                                                            /*'with'=>array('author'),*/
                                                                            ),
                                                                                                                
                                                            )
                                                );
        $this->render('index', array(
            'dataProvider' => $dataProvider,'model'=>$model));
            


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

	
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Questions');
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
		$model=Questions::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='questions-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
