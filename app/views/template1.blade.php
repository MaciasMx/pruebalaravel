@if ($name == 'Walter White' OR $name == 'Jesse Pinkman')
	<h1>Goodbye Breaking Bad</h1>
@else
	<h1>Hello {{ $name }} </h1>
@endif