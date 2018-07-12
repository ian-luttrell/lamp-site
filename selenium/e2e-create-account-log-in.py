#!/usr/bin/python3

# -*- coding: utf-8 -*-
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import NoAlertPresentException
import unittest, time, re, sys

class CreateAccountLogIn(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Firefox()
        self.driver.implicitly_wait(30)
        self.base_url = "https://www.katalon.com/"
        self.verificationErrors = []
        self.accept_next_alert = True
    
    def test_create_account_log_in(self):
        driver = self.driver
  
        driver.get("https://ianluttrell.com")
        driver.find_element_by_link_text("Create Account").click()
       
        print(driver.find_element_by_xpath("//html").text)
        self.assertEqual("Create Account\nLogin\nPrime Factorization\n\n\n\n\n\nCreate User",
							driver.find_element_by_xpath("//html").text)

        driver.find_element_by_name("username").click()
        driver.find_element_by_name("username").clear()
        driver.find_element_by_name("username").send_keys("selenium")
        driver.find_element_by_name("password").click()
        driver.find_element_by_name("password").clear()
        driver.find_element_by_name("password").send_keys("testpass")
        driver.find_element_by_xpath("//button[@type='submit']").click()
        self.assertEqual("Create Account\nLogin\nPrime Factorization\n\n\nCreated user selenium.", driver.find_element_by_xpath("//html").text)
        driver.find_element_by_link_text("Login").click()
        self.assertEqual("Create Account\nLogin\nPrime Factorization\n\n\n\n\n\nLog In", driver.find_element_by_xpath("//html").text)
        driver.find_element_by_name("username").click()
        driver.find_element_by_name("username").clear()
        driver.find_element_by_name("username").send_keys("selenium")
        driver.find_element_by_name("password").click()
        driver.find_element_by_name("password").clear()
        driver.find_element_by_name("password").send_keys("testpass")
        driver.find_element_by_xpath("//button[@type='submit']").click()
        self.assertEqual("Logged in as selenium\nLog Out\nCreate Account\nLogin\nPrime Factorization\n\n\nSucccessfully logged in as selenium.",             
                            driver.find_element_by_xpath("//html").text)
        driver.find_element_by_xpath("//button[@type='submit']").click()
        self.assertEqual("Create Account\nLogin\nPrime Factorization\n\n\n\n\n\nLog In", driver.find_element_by_xpath("//html").text)
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
