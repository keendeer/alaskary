<ul class="list-group">
    <li class="list-group-item node-default-treeview">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-{{8-$timer}} offset-md-{{$timer++}}">
                <?php 
                    $dash = '';
                    for ($i=1; $i < $timer; $i++){
                        $dash .= '<i class="la la-arrow-circle-left"></i> ';
                    }
           
                ?>
                <h4><?php echo $dash; ?>{{$child_branch->name}}</h4>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group text-right" style="margin-bottom: auto;">
                    <!-- Floating icon Outline button -->
                    <a href="{{route('branch.show', $child_branch->id)}}" class="btn btn-icon btn-primary mr-1 btn11"><i class="la la-plus"></i> اضف منتجات</a>
                    <a href="{{route('branch.edit', $child_branch->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                    <button type="button" data-id="{{$child_branch->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                </div>
            </div>
        </div>
    </li>
    @if ($child_branch->mainBranch)
      
        @foreach ($child_branch->mainBranch as $childBranch)
            @include('layouts.branch.child01', ['child_branch' => $childBranch])
        @endforeach

    @endif
</ul>