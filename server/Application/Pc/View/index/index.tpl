{%foreach from=$result  item=temp%}
	{%foreach from=$temp item=val key=lx%}
		{%if $lx == 'detail' || $lx == 'user_info' %}
				{%foreach from=$val item = val1 key = lx1%}
					{%$val1%}
				{%/foreach%}
		<br/>
		{%elseif $lx == 'comment_list' %}
				{%foreach from=$val item = val1 key = lx1%}
					{%foreach from=$val1 item = val2 key = lx1%}
						{%if $lx1 == 'user_info' %}
								{%foreach from=$val2 item = val3 key = lx2%}
									{%$val3%}
								{%/foreach%}
						<br/>
						{%else%}

							{%$val2%}

						{%/if%}

					{%/foreach%}
				{%/foreach%}
		<br/>

		{%else%}
			{%$val%}
		{%/if%}
	{%/foreach%}<br/>
{%/foreach%}