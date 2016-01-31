{% extends "layout.php" %}

{% block tabActivo %}inicio{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<h1>Gracias por enviarnos su opinión "{{nombre}}"</h1>
	<p class="lead">Lo que piensa nos resulta de gran utilidad, gracias por compartirlo.</p>
	<p>Próximamente nos pondremos en contacto con ud. en la dirección <strong>{{correo}}</strong> que nos ha suministrado.</p>
</div>

{% endblock cuerpo %}

