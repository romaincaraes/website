import os
from dotenv import load_dotenv
from django.shortcuts import render

load_dotenv()

def contact(request):
    context = {
        'email': os.environ.get('EMAIL_ADDRESS'),
        'phone': os.environ.get('PHONE_NUMBER'),
        'website': os.environ.get('WEBSITE_URL'),
        'linkedin_label': os.environ.get('LINKEDIN_LABEL'),
        'linkedin_url': os.environ.get('LINKEDIN_URL'),
        'github_label': os.environ.get('GITHUB_LABEL'),
        'github_url': os.environ.get('GITHUB_URL'),
        'form_display': "",
        'card_display': "hidden",
    }
    return render(request, 'contact.html', context=context)
