@if($channel_event->slug=="create_contacts" || $channel_event->slug=="update_contacts")
    @include('freshworks_online.create_update_contacts')
@endif