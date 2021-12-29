@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Личный кабинет</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            @if ($channelIsConnected)

                                <a href="/part_channel" class="btn btn-danger btn-large">Отключить бота</a>

                            @else

                                <a href="/join_channel" class="btn btn-success btn-large">Поключить бота</a>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

