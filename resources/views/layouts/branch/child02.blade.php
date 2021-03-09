<option value="{{$child_branch->id}}" {{$child_branch->checkIfSubOrMain($child_branch->id,$parent)}}>
	{{$child_branch->name}}
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
  
    @foreach ($child_branch->mainBranch as $childBranch)
        @include('layouts.branch.child02', ['child_branch' => $childBranch, 'id' => $branchh->id, 'parent' => $branchh->branch_id])
    @endforeach

@endif