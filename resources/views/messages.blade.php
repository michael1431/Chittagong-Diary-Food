@if ($errors->any())
    <div class="alert alert-danger">
    	<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(Session::has('success'))

<div class="alert alert-success">

	<!-- show the msg by using get method,has method use for checking -->

	<p>{{ Session::get('success') }}</p>


</div>



@endif


@if(Session::has('error'))

<div class="alert alert-danger">

    <!-- show the msg by using get method,has method use for checking -->

    <p>{{ Session::get('error') }}</p>


</div>



@endif
