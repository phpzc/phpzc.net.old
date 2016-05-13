<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        {% block head %}

        {% endblock %}
        </head>
    <body>
        <div class="container">
            {{ content() }}


        </div>

        {# footer block #}
        <div class="footer">{% block footer %} {% endblock %}</div>

    </body>
</html>
