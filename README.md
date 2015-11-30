# primal
Primal it's a PHP framework for template and SQL query manage.

##Use##
For use Primal you must to have the follow folder distribution:
- proyect_folder/
  - admin/
  - config/
  - kernel/
  - packages/
    - your_package/
     - model/
        - your_model1.php
        - your_model2.php
        - ...
     - templ/
        - your_template1.html
        - your_template2.html
        - ...
     - view/
        - your_view1.php
        - your_view2.php
        - ...
  
*The names are mandatory*
#Creating a model#
A model reprecent directly a table in the data base, the model it's an interface for manipulate the datas stored in your data base.
For define an *model* you need to define an extended **Model** class.
```php
Kernel::package('package1');
class Datos_personales extends Model{
```
for all models you ever will have to use the *Kernel::packeage* method for specify that model own this package.
but never will need import the *Model* class, because it is imported by default.

So you have to define your fields and contrains field.
```php
  private $id;
  private $first_name;
  private $last_name;
  private $tel;
  
  public function __construct(){
    $this->id = Constrain::pk($this);
    $this->first_name = Input::create_text('first_name');
    $this->last_name = Input::create_text('last_name');
    $this->tel = Input::create_integer('tel');
  }
  /* So your getters and setters */
```
- The *Constrain::pk* method spesify the primary key for this model, see about more contrains in the CONSTRAINS.md tuto.
- The *Input::create_text* and *Input::create_integer* methods specify a varchar and int column respectlt in the table reprecented by this model, read about more inputs in the INPUTS.md tuto.
