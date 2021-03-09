<option value="{{$child_branch->id}}">{{$child_branch->name}} 

	<?php 

		$timer = $timer + 1;

		$dash = '';

		for ($i=0; $i < $timer; $i++){

			$dash .= '&#10229;';

		}

		echo $dash;

	?>

</option>

@if ($child_branch->mainBranch)
  
    @foreach ($child_branch->mainBranch as $childCategory)
        @include('layouts.branch.child', ['child_branch' => $childBranch])
    @endforeach

@endif