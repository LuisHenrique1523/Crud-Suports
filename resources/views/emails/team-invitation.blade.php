@component('mail::message')
{{ __('Você foi convidado para se juntar à equipe :team!', ['team' => $invitation->team->name]) }}

@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
{{ __('Caso ainda não tenha uma conta, você pode criar uma clicando no botão abaixo. Após criar uma conta, você pode clicar no botão de aceitação do convite neste e-mail para aceitar o convite da equipe:') }}

@component('mail::button', ['url' => route('register')])
{{ __('Create Account') }}
@endcomponent

{{ __('Se você já possui uma conta, pode aceitar este convite clicando no botão abaixo:') }}

@else
{{ __('Você pode aceitar este convite clicando no botão abaixo:') }}
@endif


@component('mail::button', ['url' => $acceptUrl])
{{ __('Aceitar Convite') }}
@endcomponent

{{ __('Se você não esperava receber um convite para esta equipe, pode descartar este e-mail.') }}
@endcomponent
