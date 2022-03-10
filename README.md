# Kris-Kringle-Generator-PHP

My wife has a large family, and every Christmas, each family member would buy a gift for every other family member. It was incredibly expensive and burdensome, but nobody thought to change it.

Until, finally, someone learned about the "Kris Kringle" method of gift-giving, where you randomly pair people as gift givers, unbeknownst to each other, and on Christmas morning, that person will seek out their gift-recipient and present them their gift.
For example, Harry might draw Hermione's name, Hermione draws Hagrid's name, Ron draws Harry's name, and Hagrid draws Ron's name.
The rule was that the gift couldn't be more than $25, and couldn't be cash or a gift certificate.

This method has so many advantages:
- It's radically cheaper.
- It becomes a fun challenge, as you can now focus on finding 1 appropriate & interesting gift for your person.
- It adds an element and mystery and curiosity for Christmas morning when the gifts are revealed.

The problem was that we needed to draw names from a hat, but some of the relatives lived far away and wouldn't be around unti Christmas.
I thought about dropping out and being the admin to randomly link names, but I wanted to participate too, so I devised this method to use the web, so everybody can get their name from the website.
I would still act as admin and email each person their code, but the beauty of the design is that the codes are encrypted so that, even though I'm handling the codes, I'm still just as in the dark about who each person got.

Here's how to use it:
You put the list of names in both KringleGenerator.php and KringleGenerator.htm.
Next, the admin opens KringleGenerator.php in a web browser, and gets a list like this:

![Screen Shot 2022-03-09 at 8 30 40 PM](https://user-images.githubusercontent.com/4951823/157589817-8bbab599-c5a6-4f27-9847-9e1af6431309.png)

Each code is sent to each person. Since the codes are the same length, the admin (who will also be participating) cannot tell what names were assigned.
When the person gets their code, they type it into Kringle.php, and they see this:

![Screen Shot 2022-03-09 at 8 32 28 PM](https://user-images.githubusercontent.com/4951823/157590032-84db957e-c89b-4d95-8586-85aed56bebac.png)


