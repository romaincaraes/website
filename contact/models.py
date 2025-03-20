from django.db import models

class ContactForm(models.Model):
    firstName = models.CharField(max_length=200)
    lastName = models.CharField(max_length=200)
    email = models.EmailField()
    phone = models.CharField(max_length=40)
