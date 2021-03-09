<option value="{{$child_category->id}}" 
	@if(isset($item_cat_id))
	{{$child_category->checkIfSubOrMain($child_category->id,$item_cat_id)}}
	@endif>
	{{$child_category->name}} 

	<?php 

		$timer = $timer + 1;

		$dash = '';

		for ($i=0; $i < $timer; $i++){

			$dash .= '&#10229;';

		}

		echo $dash;

	?>

</option>

@if ($child_category->mainCategory)
  
    @foreach ($child_category->mainCategory as $childCategory)
        @include('layouts.category.child', ['child_category' => $childCategory])
    @endforeach

@endif