import os
from django.shortcuts import render

def index(request):
    context = {
        'linkedin_label': os.environ.get('LINKEDIN_LABEL'),
        'linkedin_url': os.environ.get('LINKEDIN_URL'),
        'github_label': os.environ.get('GITHUB_LABEL'),
        'github_url': os.environ.get('GITHUB_URL'),
    }
    return render(request, 'index.html', context=context)
