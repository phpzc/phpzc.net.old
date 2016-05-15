<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {# 标题 #}
        {{  tag.getTitle() }}

        {# 头部 css js加载 #}
        {% block head %}

        {% endblock %}

        {{ javascript_include('213') }}
        {{ stylesheetLink('2131') }}
    </head>
    <body>
        <div class="container">
            {{ content() }}


        </div>

        {# footer block #}
        <div class="footer">{% block footer %} {% endblock %}</div>

    </body>
</html>
