@extends('header')

@section('content')

    {!! Former::open($url)
            ->addClass('col-md-10 col-md-offset-1 warn-on-exit')
            ->method($method)
            ->rules([]) !!}

    @if ($voip)
      {!! Former::populate($voip) !!}
      <div style="display:none">
          {!! Former::text('public_id') !!}
      </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
            <div class="panel-body">

                {!! Former::text('name') !!}
{!! Former::textarea('description') !!}


            </div>
            </div>

        </div>
    </div>

    <center class="buttons">

        {!! Button::normal(trans('texts.cancel'))
                ->large()
                ->asLinkTo(URL::to('/voip'))
                ->appendIcon(Icon::create('remove-circle')) !!}

        {!! Button::success(trans('texts.save'))
                ->submit()
                ->large()
                ->appendIcon(Icon::create('floppy-disk')) !!}

    </center>

    {!! Former::close() !!}


    <script type="text/javascript">

        $(function() {
            $(".warn-on-exit input").first().focus();
        })

    </script>
    

@stop
