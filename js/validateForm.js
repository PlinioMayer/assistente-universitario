function checkPattern(value, patterns)
{
	if(value)
	{
		if(Array.isArray(patterns))
		{
			for(let i = 0; i < patterns.length; i++)
			{
				if(patterns[i] instanceof RegExp)
				{
					if(!patterns[i].test(value))
					{
						return i;
					}
				}
				else
				{
					if(value !== patterns[i])
					{
						return i;
					}
				}
			}

			return true;
		}
		else
		{
			if(patterns instanceof RegExp)
			{
				return ((patterns.test(value)) ? true : 0);
			}
			else
			{
				return ((value === patterns) ? true : 0);
			}
		}
	}
	else
	{
		return 0;
	}
}

function removeWarning(event)
{
	if(Array.isArray(event.currentTarget.warning))
	{
		for(let i = 0; i < event.currentTarget.warning.length; i++)
		{
			event.currentTarget.warning[i].style.display = "none";
		}
	}
	else
	{
		event.currentTarget.warning.style.display = "none";
	}
}

function validateForm(event)
{
	if(event.currentTarget.validate)
	{
		let index;
		let valid = true;
		
		if(Array.isArray(event.currentTarget.validate))
		{
			for(let i = 0; i < event.currentTarget.validate.length; i++)
			{
				if((index = checkPattern(event.currentTarget.validate[i].value, event.currentTarget.validate[i].regExp)) !== true)
				{
					if(Array.isArray(event.currentTarget.validate[i].warning))
					{
						console.log(index);
						event.currentTarget.validate[i].warning[index].style.display = "inline-block";
					}
					else
					{
						event.currentTarget.validate[i].warning.style.display = "inline-block";
					}

					valid = false;
				}
			}

			if(valid)
			{
				event.currentTarget.form.submit();
			}
		}
		else
		{
			if((index = checkPattern(event.currentTarget.validate.value, event.currentTarget.validate.regExp)) !== true)
			{
				if(Array.isArray(event.currentTarget.validate.warning))
				{
					event.currentTarget.validate.warning[index].style.display = "inline-block";
				}
				else
				{
					event.currentTarget.validate.warning.style.display = "inline-block";
				}
			}
			else
			{
				event.currentTarget.form.submit();
			}
		}
	}
	else
	{
		event.currentTarget.form.submit();
	}
}