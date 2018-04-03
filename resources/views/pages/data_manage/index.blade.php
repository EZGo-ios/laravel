@extends('main')

@section('title', '| index')

@section('stylesheets')
	{!! Html::style('css/jeff_css/index_css/set2.css') !!}
	{!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection
	
@section('content')

	<div class="zoologo">
    	<img src="images/zoologoWithWood.png">
    </div>
    	
	<div class="grid">
		<figure class="effect-ming">
			<img src="images/manageAnimals.png" alt="manageAnimals"/>
			<figcaption>
				<h1>管理 <span>動物</span></h1>
				<p>對動物的地理位置做增刪改查</p>
				<a href="{{ route('animalPosts.index') }}">View more</a>
			</figcaption>			
		</figure>
		<figure class="effect-ming">
			<img src="images/manageChallenges.png" alt="manageChallenges"/>
			<figcaption>
				<h1>管理 <span>題目</span></h1>
				<p>對闖關單的題目做增刪改查</p>
				<a href="{{ route('questionPosts.index') }}">View more</a>
			</figcaption>			
		</figure>
	</div>	
	
@endsection

@section('javascripts')
	<script>
		// For Demo purposes only (show hover effect on mobile devices)
		[].slice.call( document.querySelectorAll('a[href="#"') ).forEach( function(el) {
			el.addEventListener( 'click', function(ev) { ev.preventDefault(); } );
		} );
	</script>
@endsection
