<form method="get" action="" id="searchForm">
    @csrf

    <div class="row">
        <div class="col-8 mb-2">

            <input type="text" class="form-control" name="filter" id="filter"
                   placeholder="Filter Course Name Or Description"
                {{ request()->filter = "value=". request()->filter ."" }}>
        </div>
        <div class="col mb-2">

            <select class="form-control" name="filterSelect" id="filterSelect">
                <option value="">All Programmes</option>
                @foreach($defaults as $default)
                <option  value="{{$default->id}}" {{ request()->filterSelect == "$default->id" ? 'selected' : '' }}>{{strtoupper($default->name)}}</option>
                @endforeach
            </select>
            {{--@foreach($tests as $name)
                <p>{{$name->name}}</p>
            @endforeach--}}
        </div>
    </div>
</form>
<hr>
