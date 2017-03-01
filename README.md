# Form Builder for Bootstrap 4 Alpha 6

Provides extra functionality for creating bootstrap markup.

## Installation

Assumption: Bootstrap 4 is ready and installed into the project.

Begin by installing this package through Composer. Run the following from the terminal or edit composer.json and update:

~~~
composer require "slakbal/html":"*"
~~~

Next, add your new provider to the providers array of config/app.php. Remove any other provider for example the standard form builder.

~~~
  'providers' => [
    // ...
    //Collective\Html\HtmlServiceProvider::class,
    Slakbal\Html\HtmlServiceProvider::class,
    // ...
  ],
~~~

Now add two class aliases to the aliases array of config/app.php. Using the aliases from the Laravel collective package

~~~
  'aliases' => [
    // ...
    'Form' => Collective\Html\FormFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,
    // ...
  ],
~~~

## Example

Note that the package has it's own function names, due to different method signature. The normal form methods are also available but won't provide the extra bootstrap markup.

~~~
{!! Form::open(['route' => 'home', 'id'=> 'account_form', 'method' => 'POST', 'role' => 'update', 'class' => 'form-vertical', 'files' => false]) !!}
    {!! Form::textField( 'title', $label = 'Title', $value = null, $help = 'Help', $attributes = [ 'placeholder' => 'Example help text that remains unchanged' ], $type = '' ) !!}
    {!! Form::textField( 'name', $label = 'Name', $value = null, $help = 'Help', $attributes = [ 'placeholder' => 'please provide your firstname' ], $type = '' ) !!}
    {!! Form::checkboxField( 'check', $label = 'Receive our occasional newsletter and other updates', $value = 1, $checked = false, $attributes = [], $type = null ) !!}
    {!! Form::passwordField( 'password', $label = 'Password', $help = 'Help', $attributes = [ ], $type = '' ) !!}
    {!! Form::inlineCheckboxField( 'inline-check', $label = 'inline checkbox', $value = 1, $checked = false, $attributes = [], $type = null ) !!}
    {!! Form::textareaField( 'bio', $label = 'Bio', $value = null, $help = 'Help', $attributes = [ 'rows' => 10,'cols' => 50, 'placeholder' => 'tell us something' ], $type = '' ) !!}
    {!! Form::dateField( 'date', $label = 'Date', $value = \Carbon\Carbon::now(), $help = 'Help', $attributes = [ ], $type = '' ) !!}
    {!! Form::fileField( 'file', $label = 'File', $value = null, $help = 'This is some placeholder block-level help text for the above input. It\'s a bit lighter and easily wraps to a new line.', $attributes = [ 'placeholder' => 'upload a file to the server' ], $type = '' ) !!}
    {!! Form::numberField( 'number', $label = 'Some Number', $value = null, $help = 'Help', $attributes = [ ], $type = '' ) !!}
    {!! Form::submitButton( 'Submit', $tooltip = '', $disabled = false, $colour = 'success', $size = 'md', $attributes = [ ] ) !!}
    {!! Form::linkButton( '#', 'linkButton', $tooltip = 'This is a link button', $disabled = false, $colour = 'primary', $size = 'md', $attributes = [ ] ) !!}
{{ Form::close() }}
~~~