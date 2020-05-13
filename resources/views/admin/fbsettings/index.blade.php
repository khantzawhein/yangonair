@extends('admin.layouts.layout')
@section('title', 'Fb Settings')
@section('header', 'Facebook settings')
@section('breadcrumb')
<li class="breadcrumb-item">YangonAQI Admin</li>
<li class="breadcrumb-item active"><a href="{{ route('admin') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Facebook Settings</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="lists-template">
                    <a href="{{ route('fb-settings.create') }}">
                        <button class="btn btn-app"><i class="fas fa-plus"></i>Add New</button>
                    </a>

                    <ul class="nav nav-tabs nav-pills" id="categoryTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="Good-tab" data-toggle="tab" href="#Good" role="tab" aria-controls="Good" aria-selected="true">Good</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Moderate-tab" data-toggle="tab" href="#Moderate" role="tab" aria-controls="Moderate" aria-selected="false">Moderate</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="USG-tab" data-toggle="tab" href="#USG" role="tab" aria-controls="USG" aria-selected="false">USG</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Unhealthy-tab" data-toggle="tab" href="#Unhealthy" role="tab" aria-controls="Unhealthy" aria-selected="false">Unhealthy</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="VeryUnhealthy-tab" data-toggle="tab" href="#VeryUnhealthy" role="tab" aria-controls="VeryUnhealthy" aria-selected="false">VeryUnhealthy</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Hazardous-tab" data-toggle="tab" href="#Hazardous" role="tab" aria-controls="Hazardous" aria-selected="false">Hazardous</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="categoryTabContent">
                        <div class="tab-pane fade show active" id="Good" role="tabpanel" aria-labelledby="Good-tab">
                            @if($goodTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($goodTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        {{-- Moderate --}}
                        <div class="tab-pane fade" id="Moderate" role="tabpanel" aria-labelledby="Moderate-tab">
                            @if($moderateTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($moderateTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" data-flag=0 action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        {{-- USG --}}
                        <div class="tab-pane fade" id="USG" role="tabpanel" aria-labelledby="USG-tab">
                            @if($USGTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($USGTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" data-flag=0 action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        {{-- Unhealthy --}}
                        <div class="tab-pane fade" id="Unhealthy" role="tabpanel" aria-labelledby="Unhealthy-tab">
                            @if($unhealthyTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unhealthyTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" data-flag=0 action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        {{-- VeryUnhealthy --}}
                        <div class="tab-pane fade" id="VeryUnhealthy" role="tabpanel" aria-labelledby="VeryUnhealthy-tab">
                            @if($veryUnhealthyTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($veryUnhealthyTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" data-flag=0 action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        {{-- Hazardous --}}
                        <div class="tab-pane fade" id="Hazardous" role="tabpanel" aria-labelledby="Hazardous-tab">
                            @if($hazardousTP->isEmpty())
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                    There is nothing to display
                                </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Show</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hazardousTP as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="col-name">{{ $template->name }}</td>
                                            <td class="col-category">{{ $template->category }}</td>
                                            <td class="col-button">
                                                <a href="{{ route('fb-settings.show', $template->id) }}"><button class="btn btn-primary"><i class="far fa-eye"></i> Show</button></a>
                                            </td>
                                            <td class="col-button">
                                                <form id='delete{{ $template->id }}' class="delete" data-flag=0 action="{{ route('fb-settings.destroy',$template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id='setDefault{{ $template->id }}' class='setDefault' action="{{ route('set-default-fb', $template->id) }}" method="POST" >
                                                    @csrf
                                                </form>
                                                <button @if (!$defaults->contains($template->id))onclick="confirmDefault({{ $template->id }})" @endif  class="btn  float-left mr-2 {{ ($defaults->contains($template->id)) ? 'btn-success disabled' : 'btn-info' }}"> {{ ($defaults->contains($template->id)) ? 'Default' : 'Set Default' }}</button>
                                                <button onclick="confirmDelete({{ $template->id }})" class="btn btn-danger float-left mr-2"><i class="fas fa-trash"></i> Delete</button>
                                                <a href="{{ route('fb-settings.edit', ['id' => $template->id]) }}"><button class="btn btn-warning"><i class="far fa-edit"></i> Edit</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>
    </div>
@endsection