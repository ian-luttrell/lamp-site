#!/usr/bin/python3

# -*- coding: utf-8 -*-
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import NoAlertPresentException
import unittest, time, re

class CheckPrimeFactLogin(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Firefox()
        self.driver.implicitly_wait(30)
        self.base_url = "https://www.katalon.com/"
        self.verificationErrors = []
        self.accept_next_alert = True
    
    def test_check_prime_fact_login(self):
        driver = self.driver
        driver.get("http://localhost")
        driver.find_element_by_link_text("Login").click()
        driver.find_element_by_name("username").click()
        driver.find_element_by_name("username").clear()
        driver.find_element_by_name("username").send_keys("selenium")
        driver.find_element_by_name("password").click()
        driver.find_element_by_name("password").clear()
        driver.find_element_by_name("password").send_keys("testpass")
        driver.find_element_by_xpath("//button[@type='submit']").click()

        driver.find_element_by_link_text("Prime Factorization").click()
        self.assertEqual("Logged in as selenium\nLog Out\nCreate Account\n"
                            "Login\nPrime Factorization\n\n\nWelcome to the "
                            "prime factorization utility, selenium.",
                            driver.find_element_by_xpath("//html").text)

        driver.find_element_by_xpath("//button[@type='submit']").click()
        driver.find_element_by_link_text("Prime Factorization").click()
        self.assertEqual("Create Account\nLogin\nPrime Factorization\n\n\n"
                            "Please log in to use the "
                            "prime factorization utility.",
                            driver.find_element_by_xpath("//html").text)
        driver.close()
    
    def is_element_present(self, how, what):
        try: self.driver.find_element(by=how, value=what)
        except NoSuchElementException as e: return False
        return True
    
    def is_alert_present(self):
        try: self.driver.switch_to_alert()
        except NoAlertPresentException as e: return False
        return True
    
    def close_alert_and_get_its_text(self):
        try:
            alert = self.driver.switch_to_alert()
            alert_text = alert.text
            if self.accept_next_alert:
                alert.accept()
            else:
                alert.dismiss()
            return alert_text
        finally: self.accept_next_alert = True
    
    def tearDown(self):
        self.assertEqual([], self.verificationErrors)

if __name__ == "__main__":
    unittest.main()
