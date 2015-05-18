{%foreach from=$result  item=temp key=lx%}
	{%if $lx =='user_info'%}
		{%foreach from=$temp item = val1 key = lx1%}
			{%$val1%}
		{%/foreach%}
	{%elseif $lx =='comment_list'%}
		{%foreach from=$temp item = val1 key = lx1%}
				{%foreach from=$val1 item = val2 key = lx2%}

						{%if $lx2 =='user_info'%}
							{%foreach from=$val2 item = val3 key = lx3%}
								{%$val3%}
							{%/foreach%}

						{%else%}
							{%$val2%}<br/>
						{%/if%}

				{%/foreach%}
		{%/foreach%}
	{%else%}
		{%$temp%}<br/>
	{%/if%}

{%/foreach%}