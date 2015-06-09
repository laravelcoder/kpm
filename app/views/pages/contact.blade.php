@extends('base')

@section('title') {{_('Контакти')}} @stop

@section('content')
	<div class="contact_box">
	  	<div class="map">
	       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20193.09316700601!2d25.325409472233932!3d50.754499893348125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472599e448f52d5b%3A0x52c2c27b6b470c3c!2z0LLRg9C7LiDQn9C-0YLQsNC_0L7QstCwLCA5LCDQm9GD0YbRjNC6LCDQktC-0LvQuNC90YHRjNC60LAg0L7QsdC70LDRgdGC0YwsIDQzMDAw!5e0!3m2!1suk!2sua!4v1433164486600" width="600" height="450" frameborder="0" style="border:0"></iframe>
	    </div>
	    <div class="container">
		 <div class="col-md-9">
		 	<div class="single_contact contact_left">
	  			  <h1>{{_('Контактна інформація')}}</h1>
	  			  <style>
	  			  	.single_contact p {
	  			  		margin-bottom: 0px;
	  			  	}
	  			  </style>
	  			  @if( $errors->all() )
				    <div class="alert alert-danger">
				        <p><strong>{{_('Помилка')}}</strong></p>
				        @foreach ($errors->all('<p>:message</p>') as $msg)
				            {{ $msg }}
				        @endforeach
				    </div>
				@endif

				@if( $success->all() )
				    <div class="alert alert-success">
				        @foreach ($success->all('<p>:message</p>') as $msg)
				            {{ $msg }}
				        @endforeach
				    </div>
				@endif
	  			 {{ Form::open( array('class'=>'form-horizontal form-top-margin' , 'role'=>'form' ) ) }}
					<div class="column_2">
						{{ Form::text( "from" , Input::old( "from" ) , array( 'class'=>'text' , 'placeholder'=>_('Імя') ) ) }}
						{{ Form::text( "subject" , Input::old( "subject" ) , array( 'class'=>'text' , 'placeholder'=>_('Тема'), 'style' => 'margin-left:2.7%;' ) ) }}
						{{ Form::text( "email" , Input::old( "email" ) , array( 'class'=>'text' , 'placeholder'=>_('Ел. пошта'), 'style' => 'margin-left:2.7%;' ) ) }}
					</div>
					<div class="column_3">
	                    {{ Form::textarea( "body" , Input::old( "body") , array('placeholder'=>_('Повідомлення'), 'rows' => 10 ) ) }}
	                </div>
	                <div class="form-submit1">
			           <input type="submit" value="{{_('Відправити')}}">
					</div>
					<div class="clearfix"> </div>
				{{Form::close()}}
		       </div>
		 </div>
		 <div class="col-md-3 contact_right">
		 	<h2>{{_('Контакти')}}</h2>
		 	@if ($adress)
		 		{{$adress->body}}
		 	@endif
		 	<h2 class="m_5">{{_('Години роботи')}}</h2>
		 	@if ($info)
		 		{{$info->body}}
		 	@endif
		 </div>
	 </div>
</div>
@stop