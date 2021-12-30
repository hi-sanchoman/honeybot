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


                            <h2>Памятка:</h2>
                            <p>1. Сделать бота модератором: /mod BotHeroes3</p>
                            <p>2. Первый вопрос через 5 минут после подключения к боту</p>
                            <p>3. Интервал между вопросами - 30 минут</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

