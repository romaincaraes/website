import os

this_file = ".venv/bin/activate_this.py"
exec(open(this_file).read(), {'__file__': this_file})

from django.core.wsgi import get_wsgi_application

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'website.settings')

application = get_wsgi_application()
