Feature: Share photo
  In order to share photos to friends
  As a photographer
  I want to upload a photo to droplr

@javascript
Scenario: Choice a photo to upload
  Given I am on "/hello"
  When attach the file "foo.jpg" to "upload-file"
  Then should see "Success!"
