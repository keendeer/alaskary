<option value="{{$child_category->id}}" {{$child_category->checkIfSubOrMain($child_category->id,$parent)}}>
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
        @include('layouts.category.child02', ['child_category' => $childCategory, 'id' => $categoryy->id, 'parent' => $categoryy->category_id])
    @endforeach

@endif