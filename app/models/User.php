<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public $errors;
	protected $fillable = array('email', 'full_name', 'password');
	//protected $perPage = 2;

	public function isValid($data)
	{
		$rules = array(
			'email'		=> 'required|email|unique:users,email',
			'full_name'	=> 'required|min:4|max:40',
			'password'	=> 'min:8|confirmed'
		);

		//Si el usuario existe:
		if ($this->exists)
		{
			//Evitamos que la regla "Unique" tome en cuenta el email del usuario actual
			$rules['email'] .= ',' . $this->id;
		}
		else //Si no existe...
		{
			//La clave es obligatoria:
			$rules['password'] .= '|required';
		}

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
		{
			return true;
		}

		$this->errors = $validator->errors();

		return false;
	}

    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }

	public function validAndSave($data)
	{
		//Revisamos si la data es valida
		if ($this->isValid($data))
		{
			//Si la data es valida se la asignamos al usuario
			$this->fill($data);
			//Guardamos el usuario
			$this->save();

			return true;
		}

		return false;
	}

}