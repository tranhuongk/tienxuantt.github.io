<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>XSL tutorial</title>
            </head>
        </html>
        <body>
        <!-- <div>
            <xsl:value-of select="bookshop/book[1]/shipping/VN" />
            <br/>
            <xsl:value-of select="bookshop/book[1]/weight" />
            <br/>
            <xsl:value-of select="bookshop/book[last()]" />
             <xsl:value-of select="bookshop/book[last()-1]" />
             <xsl:value-of select="bookshop/book[@id]" />
             <xsl:value-of select="bookshop/book[@id=2]" />
        </div> -->
        <div>
            <!-- <xsl:for-each select="bookshop/book">
                 <xsl:value-of select="title" /> <br/>
                 <xsl:value-of select="." /> <br/>
                 
            </xsl:for-each> -->
             <!-- <xsl:for-each select="bookshop/book[price/sale &gt; 30]">
                 <xsl:value-of select="title" /> <br/>
                 
            </xsl:for-each> -->
            <!-- <xsl:for-each select="bookshop/book[price/sale &gt; price/saleoff]">
                 <xsl:value-of select="title" /> <br/>
                 
            </xsl:for-each> -->
             <xsl:for-each select="bookshop/book[price/sale = 30]">
                 <xsl:value-of select="title" /> <br/>
            </xsl:for-each>
        </div>
        </body>
    </xsl:template>
</xsl:stylesheet>