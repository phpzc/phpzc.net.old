{{ form('sign/index') }}
<fieldset>
    <div>
        <label for="email">Username/Email</label>
        <div>
            {{ text_field('username') }}
        </div>
    </div>
    <div>
        <label for="password">Password</label>
        <div>
            {{ password_field('password') }}
        </div>
    </div>

    <div>
        <label for="password">name</label>
        <div>
            {{ textArea('name') }}

            {{ radio_field('date') }}
        </div>
    </div>
    <div>
        {{ submit_button('Login') }}
    </div>
</fieldset>
</form>

<p>{{ flashSession.output() }}</p>