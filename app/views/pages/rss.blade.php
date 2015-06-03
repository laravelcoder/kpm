<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>{{_('Новини')}}</title>
    <link>{{url(action('NewsController@getIndex'))}}</link>
    <description>{{_('Новини кафедри прикладної математики та інформатики')}}</description>
    @foreach ($news as $item)
      <item>
         <title>{{$item->title}}</title>
         <link>{{url(action('NewsController@getView', array($item->slug)))}}</link>
         <description>{{$item->descr}}</description>
      </item>
    @endforeach
  </channel>
</rss>