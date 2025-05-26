@extends('layouts/app')
@section('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('button')
<div class="header__logout">
        <a class="header__button" href="/login">logout</a>
</div>
@endsection

@section('content')
<div class="admin-content">
    <div class="admin-content__heading">
        <h2>Admin</h2>
    </div>

    <div class="admin-content__table">
        <div class="admin-content__search">
            <form class="search-form" action="/admin/search" method="get">
                @csrf
                <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{old('keyword')}}" />
                <select class="search-form__item-gender" name="gender">
                    <option value="" selected hidden>性別</option>
                    <option value="男性">男性</option>
                    <option value="女性">女性</option>
                    <option value="その他">その他</option>
                </select>
                <select class="search-form__item-category" name="category_id">
                    @foreach($categories as $category)
                    <option value="" selected hidden>選択してください</option>
                    <option value="{{$category['id']}}">{{$category['content']}}</option>
                    @endforeach
                </select>
                <input type="date" class="search-form__item-date" name="created_at">
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                </div>
                <div class="search-form__button">
                    <button class="search-form__button-reset" type="submit">リセット</button>
                </div>
            </form>
        </div>

        <div class="admin-content__page">
            <button class="button__export">エクスポート</button>

        </div>

        <div class="admin-table">
            <table class="admin-table__inner">
                <tr class="admin-table__row">
                    <th class="admin-table__header">
                        <div class="admin-table__header-span">お名前</div>
                    </th>
                    <th class="admin-table__header">
                        <div class="admin-table__header-span">性別</div>
                    </th>
                    <th class="admin-table__header">
                        <div class="admin-table__header-span">メールアドレス</div>
                    </th>
                    <th class="admin-table__header">
                        <div class="admin-table__header-span">お問い合わせの種類</div>
                    </th>
                    <th class="admin-table__header">
                        <div class="admin-table__header-span"></div>
                    </th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__item">
                        <div class="admin-list__item">
                            <p class="admin-list__item-p">{{$contact['last_name']}}{{$contact['first_name']}}</p>
                            <input type="hidden" name="id" value="{{$contact['id']}}">
                        </div>
                    </td>
                    <td class="admin-table__item">
                        <div class="admin-list__item">
                            <p class="admin-list__item-p">{{$contact['gender']}}</p>
                            <input type="hidden" name="id" value="{{$contact['id']}}">
                        </div>
                    </td>
                    <td class="admin-table__item">
                        <div class="admin-list__item">
                            <p class="admin-list__item-p">{{$contact['email']}}</p>
                            <input type="hidden" name="id" value="{{$contact['id']}}">
                        </div>
                    </td>
                    <td class="admin-table__item">
                        <div class="admin-list__item">
                            <p class="admin-list__item-p">{{$contact['category']['content']}}</p>
                            <input type="hidden" name="id" value="{{$contact['id']}}">
                        </div>
                    </td>
                    <td class="admin-table__item">
                        <div class="admin-list__item">
                            <label for="modalToggle" class="modal-window__button-open">詳細</label>
                            <input type="hidden" name="id" value="{{$contact['id']}}">
                            <input type="checkbox" id="modalToggle" class="modal-checkbox">
                            <div class="modal-window" id="modal">
                                <div class="modal-wrapper">
                                    <label for="modalToggle" class="modal-window__button-close">×</label>
                                    <div class="modal-content">
                                        <form class="delete-form" action="/admin/delete" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-table">
                                                <table class="modal-table__inner">
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">お名前</th>
                                                        <td class="modal-table__text">{{ $contact['last_name'] }}{{ $contact['first_name'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">性別</th>
                                                        <td class="modal-table__text">{{ $contact['gender'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">メールアドレス</th>
                                                        <td class="modal-table__text">{{ $contact['email'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">電話番号</th>
                                                        <td class="modal-table__text">{{ $contact['tel'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">住所</th>
                                                        <td class="modal-table__text">{{ $contact['address'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">建物名</th>
                                                        <td class="modal-table__text">{{ $contact['building'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">お問い合わせの種類</th>
                                                        <td class="modal-table__text">{{ $contact['category']['content'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                    <tr class="modal-table__row">
                                                        <th class="modal-table__header">お問い合わせ内容</th>
                                                        <td class="modal-table__text">{{ $contact['detail'] }}
                                                            <input type="hidden" name="id" value="{{$contact['id']}}">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-window__button-delete">
                                                <button class="delete">削除</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection