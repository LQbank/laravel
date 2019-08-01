@extends('admin.layout.index')

@section('content')
<style>
        .up{
            width:98%;
            border:1px solid #ccc;
            border-radius:3px;
            background-color:#eee;
        }
        .down{
            width:98%;
            border:1px solid #ccc;
            border-radius:3px;
            background-color:orange;
        }

        .sku{
            color:#666;
            margin-top:5px;
        }

        .price{
            color:#666;
            margin-top:-10px;
        }
    </style>
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-pictures"></i>{{ $name }}</span>
            <a href="/admin/goods" class='btn btn-warning pull-right' style="margin-top:-28px;">返回</a>
        </div>
        <div class="mws-panel-body">
            <ul class="thumbnails mws-gallery">
            @foreach($res as $res)
                <li style="height:300px;">
                    <span class="thumbnail"><img style="height:200px;" src="{{ $res->pic }}" style="height:200px;" alt=""></span>
                    <span class="mws-gallery-overlay">
                        <a href="" rel="prettyPhoto[gallery1]" class="mws-gallery-btn"><i class="icon-search"></i></a>
                        <a href="#" class="mws-gallery-btn"><i class="icon-pencil"></i></a>
                        <a href="/admin/goods/changeskustatus/{{ $res->id }}/{{ $name }}/{{ $res->status }}/{{ $id }}" id="{{ $res->id }}" class="mws-gallery-btn shangxia">
                            @if($res->status == 1)
                                <i id="{{ $res->id }}" class="icon-arrow-down"></i>
                            @else
                                <i id="{{ $res->id }}" class="icon-arrow-up"></i>
                            @endif
                        </a>
                    </span>

                    @if($res->status == 1)
                        <div class='up'>
                    @else
                        <div class='down'>
                    @endif
                   
                        <p class='sku'>{{ $res->sku }}</p>
                        <p class='price'>{{ $res->price }}¥、{{ $res->num }}件</p>
                    </div>
                </li>
            @endforeach      
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script src="/file/plugins/prettyphoto/js/jquery.prettyPhoto.min.js"></script>
    <script src="/file/js/demo/demo.gallery.js"></script>

@endsection