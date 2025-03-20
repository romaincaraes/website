import os
from dotenv import load_dotenv
from django.shortcuts import render
from .models import ContactForm

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

    if (request.method == 'POST'):
        contact = ContactForm()
        contact.firstName = request.POST.get('inputFirstName')
        contact.lastName = request.POST.get('inputLastName')
        contact.email = request.POST.get('inputEmail')
        contact.phone = request.POST.get('inputPhone')
        contact.save()

        context['form_display'] = "hidden"
        context['card_display'] = ""
        
        return render(request, 'contact.html', context=context)
    return render(request, 'contact.html', context=context)
