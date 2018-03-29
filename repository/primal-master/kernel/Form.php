<?php 
	class Form {
		private $model;
		private $errors;

		public function __construct($model){
			$this->model = $model;
		}

		function save($post){
			$this->validate($post);
			foreach ($this->get_subforms($post) as $name => $form) {
				if (isset($post[$name]) && is_array($post[$name])){
					$id = $form->save($post[$name]);
					$this->model->{"get$name"}()->set($id);
				}
			}
			$pk = $this->model->save();
			$this->model->getId()->set($pk);
			return $pk;
		}

		function edit($post){
			$this->validate($post);
			foreach ($this->get_subforms($post) as $name => $form) {
				if (isset($post[$name]) && is_array($post[$name])){
					$form->edit($post[$name]);
					$this->model->{"get$name"}()->set($post[$name]['id']);
				}
			}
			$pk = $this->model->edit();
			$this->model->getId()->set($pk);
			return $pk;
		}

		function get_subforms($post){
			$subforms = [];
			foreach ($this->get_relations() as $name => $relation) {
				$model = $relation->getReferModel();
				$obj = new $model();
				if (isset($post[$name]) && is_array($post[$name])){
					$obj->setArray($post[$name]);
				}
				$form = new Form($obj);
				$subforms [$name] = $form;
			}
			return $subforms;
		}

		function get_subform($post, $relation){
			$model = $relation->getReferModel();
			$obj = new $model();
			if (isset($post) && is_array($post)){
				$obj->setArray($post);
			}
			$form = new Form($obj);
			return $form;
		}


		function delete($post){
			$this->validate($post);
			return $this->model->delete();
		}

		function validate($post){
			$this->model->setArray($post);
			if ($this->valid($post)){
				return true;
			}
			throw new ValidationException(json_encode($this->errors));
		}

		function get_relations(){
			$relations = [];
			$reflex = new ReflectionClass($this->model->get_called_class());
			$properts = $reflex->getProperties();
			$this->errors = array();
			foreach ($properts as $propert) {
				$name = $propert->getName();
				$input = $this->model->{"get" . ucfirst($name)}();
				if ($this->is_relation($input) ){
					$relations[$name] = $input;
				}
			}
			return $relations;
		}

		function is_relation($input){
			return $input instanceof Constrain && $input->getType() == Constrain::FORAIN_KEY;
		}
		 
		function valid($post){
			//var_dump($post);
			$this->errors = array();
			$reflex = new ReflectionClass($this->model->get_called_class());
			$properts = $reflex->getProperties();
			foreach ($properts as $propert) {
				$name = $propert->getName();
				$input = $this->model->{"get" . ucfirst($name)}();
				if ($this->is_relation($input)) {
					$form = $this->get_subform($post, $input);
					if (isset($post[$name]) && is_array($post[$name]) && !$form->valid($post[$name])) {
						$this->errors[$name] = $form->errors;
					}
				} else {
					$error = $input->validate();
					if ($error){
						$this->errors[$name] = $error->getError();
					}
				}
			}
			return count($this->errors) == 0;
		}
	}
