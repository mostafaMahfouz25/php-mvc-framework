{% extends "layout.php" %}

{% block body %}

    <h1>Posts Page</h1>
    <h1>{{name}}</h1>
    <ul>
        {% for post in posts %}
        <li>
            <h2>{{ post.title }}</h2>
            <p>{{ post.content }}</p>
        </li>
        {% endfor %}

    </ul>

{% endblock %}