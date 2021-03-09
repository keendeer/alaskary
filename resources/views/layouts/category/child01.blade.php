<ul class="list-group">
    <li class="list-group-item node-default-treeview">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-{{8-$timer}} offset-md-{{$timer++}}">
                <?php 
                    $dash = '';
                    for ($i=1; $i < $timer; $i++){
                        $dash .= '<i class="la la-arrow-circle-left"></i> ';
                    }
                    echo $dash;
                ?>
                <h4>{{$child_category->name}}</h4>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group text-right" style="margin-bottom: auto;">
                    <!-- Floating icon Outline button -->
                    @can('update', $category)
                    <a href="{{route('category.edit', $child_category->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                    @endcan
                    @can('delete', $category)
                    <button type="button" data-id="{{$child_category->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                    @endcan
                </div>
            </div>
        </div>
    </li>
    @if ($child_category->mainCategory)
      
        @foreach ($child_category->mainCategory as $childCategory)
            @include('layouts.category.child01', ['child_category' => $childCategory])
        @endforeach

    @endif
</ul>